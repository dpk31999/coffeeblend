import org.apache.hadoop.conf.Configuration;

import org.apache.hadoop.fs.FSDataInputStream;

import org.apache.hadoop.fs.FileStatus;

import org.apache.hadoop.fs.FileSystem;

import org.apache.hadoop.fs.Path;

 

import org.apache.hadoop.io.IntWritable;

import org.apache.hadoop.io.DoubleWritable;

import org.apache.hadoop.io.LongWritable;

import org.apache.hadoop.io.Text;

 

import org.apache.hadoop.mapreduce.lib.input.TextInputFormat;

import org.apache.hadoop.mapreduce.lib.output.TextOutputFormat;

import org.apache.hadoop.mapreduce.Job;

import org.apache.hadoop.mapreduce.Mapper;

import org.apache.hadoop.mapreduce.Reducer;

import org.apache.hadoop.mapreduce.lib.input.FileInputFormat;

import org.apache.hadoop.mapreduce.lib.output.FileOutputFormat;

 

import java.io.BufferedReader;

import java.io.IOException;

import java.io.InputStreamReader;

import java.util.ArrayList;

import java.util.StringTokenizer;

 

  class MatrixMultiplyMapper extends Mapper <LongWritable, Text, Text, Text> {

 

    public void map(LongWritable key, Text value, Context outputMap) throws IOException, InterruptedException {

       Text outputKey = new Text();

       Text outputValue = new Text();

       outputMap.write(outputKey, outputValue);

      

    }

  }//class MatrixMultiplyMapper

 

  class MatrixMultiplyReduce extends Reducer <Text, Text, Text, Text> {

    private Text result = new Text();

       public void reduce(Text key, Iterable<Text> values, Context outputReduce) throws IOException, InterruptedException {

      result.set("Hello");

      outputReduce.write(key, result);

    }

  }//class MatrixMultiplyReduce

 

public class MatrixMultiply {   

      

       static Configuration conf;

       public int run(String pathin, String pathout) throws Exception {

             

              Job job = new Job(conf);

              job.setJarByClass(MatrixMultiply.class);

 

              job.setMapperClass(MatrixMultiplyMapper.class);

              job.setReducerClass(MatrixMultiplyReduce.class);

       

              job.setInputFormatClass(TextInputFormat.class);

              job.setOutputFormatClass(TextOutputFormat.class);   

             

              job.setOutputKeyClass(Text.class);

              job.setOutputValueClass(Text.class);

                    

              FileInputFormat.addInputPath(job, new Path(pathin));

              FileOutputFormat.setOutputPath(job, new Path(pathout));

 

              boolean success = job.waitForCompletion(true);

              return success ? 0 : -1;

    }

      

    public static void main(String[] args) throws Exception {

      

       MatrixMultiply runner = new MatrixMultiply();

      

       conf = new Configuration();

              FileSystem fs = FileSystem.get(conf);

        

       //Delete output folder if it already exists

       fs.delete(new Path(args[1]), true);

 

       runner.run(args[0], args[1]);

       

    }//main

}//MatrixMultiply